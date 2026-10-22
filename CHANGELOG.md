# Changelog — cinghie/yii2-logger

All notable changes to this package are documented in this file.

Format based on [Keep a Changelog](https://keepachangelog.com/).

### Documentation rules

- **`CHANGELOG.md` and `UPDATE.md` must always be written in English.**
- **`CHANGELOG.md` entries must use dated headings** (`## YYYY-MM-DD`, newest first).
- Never include credentials, secrets, private hosts, customer data, personal paths, exploit recipes or other sensitive operational material.

---

## 2026-10-22

### Added

- `Loggers::clientIp()` and `Loggers::sanitizeIp()` return a string IP (or empty) without passing `null` to `filter_var()`. `beforeSave()` fills or sanitizes `ip` so callers cannot persist a null IP. Values longer than the `ip` column (16) are stored empty rather than truncated.

---
