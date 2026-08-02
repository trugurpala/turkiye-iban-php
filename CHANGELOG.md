# Changelog

## Unreleased

- Fixed the GitHub release workflow so package quality checks run as a visible
  job on every push.
- Limited archive creation and GitHub Release upload to version tags, with
  write permission scoped to the publishing job.

## 0.1.5 - 2026-08-02

- Added separate tests for all seven public API functions.
- Added a user-facing release and verification report.
- Added GitHub issue forms and pull request checklist.
- Published a clean source archive without local dependencies or cache files.

## 0.1.4 - 2026-08-01

- Published the PHP client GitHub release with pinned `turkiye-iban` v0.2.1 data.
- Verified PHP 8.2, 8.3, and 8.4 CI and PHPStan level 8.
