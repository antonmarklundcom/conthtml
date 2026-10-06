/** Configuration/endpoint compatibility checks. Only synthetic credentials are used. */
import assert from 'node:assert/strict';
import { cp, mkdtemp, rm, writeFile } from 'node:fs/promises';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { execFileSync } from 'node:child_process';
const root = new URL('../', import.meta.url);
const temp = await mkdtemp(join(tmpdir(), 'contador-crm-config-'));
const env = { ...process.env };
for (const key of ['VENDERCRM_URL', 'VENDERCRM_API_KEY', 'VCRM_ENDPOINT', 'VCRM_SITE_KEY', 'GA4_ID']) delete env[key];
try {
  await cp(new URL('lib/', root), join(temp, 'lib'), { recursive: true });
  await cp(new URL('config.example.php', root), join(temp, 'config.example.php'));
  const run = (code, overrides = {}) => JSON.parse(execFileSync('php', ['-r',
    `require $argv[1].'/lib/bootstrap.php'; ${code}`, temp], { encoding: 'utf8', env: { ...env, ...overrides } }));
  const endpoint = value => run('echo json_encode([crm_endpoint(),crm_base_url()]);', { VENDERCRM_URL: value });
  assert.deepEqual(endpoint('https://crm.example.test'), ['https://crm.example.test/api/v1/leads', 'https://crm.example.test']);
  assert.deepEqual(endpoint('https://crm.example.test/api/v1/leads/'), ['https://crm.example.test/api/v1/leads', 'https://crm.example.test']);
  for (const value of ['http://crm.example.test', 'https://user:pass@crm.example.test', 'https://crm.example.test?x=1', 'https://crm.example.test/#bad', '/api/v1/leads']) {
    assert.deepEqual(endpoint(value), [null, null], `reject unsafe/ambiguous endpoint ${value}`);
  }
  assert.deepEqual(endpoint('http://127.0.0.1:9999'), ['http://127.0.0.1:9999/api/v1/leads', 'http://127.0.0.1:9999']);
  await writeFile(join(temp, 'config.php'), "<?php return ['GA4_ID'=>'G-EXISTING', 'VENDERCRM_URL'=>'https://old.example.test', 'VENDERCRM_API_KEY'=>'old-test-key'];");
  await writeFile(join(temp, 'config.crm.php'), "<?php return ['VENDERCRM_URL'=>'https://private.example.test/api/v1/leads', 'VENDERCRM_API_KEY'=>'private-test-key', 'GA4_ID'=>'G-MUST-NOT-OVERRIDE'];");
  const snapshot = 'echo json_encode([crm_endpoint(), cfg("VENDERCRM_API_KEY"), cfg("GA4_ID")]);';
  assert.deepEqual(run(snapshot), ['https://private.example.test/api/v1/leads', 'private-test-key', 'G-EXISTING']);
  assert.deepEqual(run(snapshot, { VCRM_ENDPOINT: 'https://env.example.test/api/v1/leads', VCRM_SITE_KEY: 'env-test-key' }), ['https://env.example.test/api/v1/leads', 'env-test-key', 'G-EXISTING']);
  assert.deepEqual(run(snapshot, { VCRM_ENDPOINT: 'https://alias.example.test', VENDERCRM_URL: 'https://preferred.example.test', VCRM_SITE_KEY: 'alias-key', VENDERCRM_API_KEY: 'preferred-key' }), ['https://preferred.example.test/api/v1/leads', 'preferred-key', 'G-EXISTING']);
  const formats = run('echo json_encode(array_map("lead_phone", ["0981 123 456", "981123456", "595981123456", "+46 70 123 45 67", "0046701234567"]));');
  assert.deepEqual(formats, ['+595981123456', '+595981123456', '+595981123456', '+46701234567', '+46701234567']);
  console.log('CRM configuration PASS: base/full endpoint, TLS/URL guards, private overrides, environment aliases and Paraguay/international phone formats');
} finally { await rm(temp, { recursive: true, force: true }); }
