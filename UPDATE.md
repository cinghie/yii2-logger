# yii2-logger — UPDATE roadmap

### Documentation rules

- **`CHANGELOG.md` and `UPDATE.md` must always be written in English.**
- Dated headings (`YYYY-MM-DD`, newest first).
- **`## Open — 1. Security` must always remain.**
- **`## Open — 3. Optimizations & performance` must always remain.**
- Never include credentials, secrets, private hosts, customer data, personal paths, exploit recipes or other sensitive operational material.

Urgency: **Critical** · **High** · **Medium** · **Low**.

---

## Priority list

1. Keep PHP 8.1+ `filter_var()` callers on string IPs only.

---

## Open — 1. Security

| Urgency | Item | Why | Recommended action |
|---------|------|-----|--------------------|
| — | No known release-blocking security issue | Logger IP is sanitized before persist. | Keep `Loggers::clientIp()` for new write paths. |

---

## Open — 3. Optimizations & performance

| Urgency | Item | Why | Recommended action |
|---------|------|-----|--------------------|
| — | No known release-blocking performance issue | | |

---

## Processed

### 2026-10-22 — Processed

- **PHP 8.4 logger IP:** `filter_var(null)` is invalid. `Loggers::sanitizeIp()` / `clientIp()` / `beforeSave()` keep `ip` a string (empty when missing or longer than the column).
