# WPZylos Hooks

[![PHP Version](https://img.shields.io/badge/php-%5E8.0-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![GitHub](https://img.shields.io/badge/GitHub-KYNetCode-181717?logo=github)](https://github.com/KYNetCode/wpzylos-hooks)

WordPress hook management with plugin-scoped custom hooks for WPZylos framework.

📖 **[Full Documentation](https://wpzylos.com)** | 🐛 **[Report Issues](https://github.com/KYNetCode/wpzylos-hooks/issues)**

---

## ✨ Features

- **Dual Hook API** — Separate methods for WordPress core hooks and custom plugin hooks
- **Auto-Prefixed Custom Hooks** — Plugin-scoped hooks prevent naming collisions
- **Fluent API** — Chainable methods for clean registration
- **One-Time Hooks** — Actions that self-remove after first execution
- **Hook Registry** — Introspect all registered actions and filters

---

## 📋 Requirements

| Requirement | Version |
| ----------- | ------- |
| PHP         | ^8.0    |
| WordPress   | 6.0+    |

---

## 🚀 Installation

```bash
composer require KYNetCode/wpzylos-hooks
```

---

## 📖 Quick Start

```php
use WPZylos\Framework\Hooks\HookManager;

$hooks = $app->make('hooks');

// WordPress core hooks (NEVER prefixed) — use wp* methods
$hooks->wpAction('init', [$this, 'initialize']);
$hooks->wpFilter('the_content', [$this, 'modifyContent']);

// Custom plugin hooks (ALWAYS prefixed) — use plain methods
$hooks->action('settings_saved', [$listener, 'onSettingsSaved']);
$hooks->filter('settings', [$this, 'filterSettings']);

// Fire & apply custom hooks
$hooks->doAction('settings_saved', $settings);
$filtered = $hooks->applyFilter('settings', $defaults);
```

---

## 🏗️ Core Concepts

### The Dual API

HookManager provides two distinct APIs:

| Purpose               | Register Listener            | Fire / Apply             | Remove                         |
| --------------------- | ---------------------------- | ------------------------ | ------------------------------ |
| **WordPress hooks**   | `wpAction()`, `wpFilter()`   | *(WordPress fires these)*| `removeWpAction()`, `removeWpFilter()` |
| **Custom plugin hooks** | `action()`, `filter()`     | `doAction()`, `applyFilter()` | `removeAction()`, `removeFilter()` |

**WordPress hooks** (`wp*` methods) use the hook name exactly as provided — `'init'`, `'the_content'`, etc.

**Custom plugin hooks** (plain methods) automatically prefix the hook name via `$context->hook()` to prevent collisions between plugins.

### WordPress Core Hooks

```php
// Register actions on WordPress hooks
$hooks->wpAction('init', [$this, 'onInit']);
$hooks->wpAction('admin_menu', [$this, 'registerMenu'], 20);

// Register filters on WordPress hooks
$hooks->wpFilter('the_title', [$this, 'filterTitle']);
$hooks->wpFilter('body_class', [$this, 'addBodyClasses'], 10, 2);

// Remove hooks
$hooks->removeWpAction('init', [$this, 'onInit']);
$hooks->removeWpFilter('the_title', [$this, 'filterTitle']);
```

### Custom Plugin Hooks

```php
// Register listeners on your plugin's custom hooks
// If your plugin prefix is "myplugin", 'user_created' becomes 'myplugin_user_created'
$hooks->action('user_created', [$listener, 'onUserCreated']);
$hooks->filter('settings', [$this, 'filterSettings']);

// Fire a custom action
$hooks->doAction('user_created', $user);

// Apply a custom filter
$settings = $hooks->applyFilter('settings', $defaults);

// Remove custom hook listeners
$hooks->removeAction('user_created', [$listener, 'onUserCreated']);
$hooks->removeFilter('settings', [$this, 'filterSettings']);
```

### One-Time Hooks

```php
// Executes once then removes itself automatically
$hooks->once('init', function () {
    // Runs only on the first 'init' call
});
```

### Fluent Chaining

```php
$hooks
    ->wpAction('init', [$this, 'onInit'])
    ->wpAction('admin_menu', [$this, 'registerMenu'])
    ->wpFilter('the_content', [$this, 'filterContent']);
```

---

## 📦 Related Packages

| Package                                                                | Description             |
| ---------------------------------------------------------------------- | ----------------------- |
| [wpzylos-core](https://github.com/KYNetCode/wpzylos-core)         | Application foundation  |
| [wpzylos-events](https://github.com/KYNetCode/wpzylos-events)     | PSR-14 event dispatcher |
| [wpzylos-scaffold](https://github.com/KYNetCode/wpzylos-scaffold) | Plugin template         |

---

## 📖 Documentation

For comprehensive documentation, tutorials, and API reference, visit **[wpzylos.com](https://wpzylos.com)**.

---

## ☕ Support the Project

- [GitHub Sponsors](https://github.com/sponsors/KYNetCode)
- [PayPal Donate](https://www.paypal.com/donate/?hosted_button_id=66U4L3HG4TLCC)

---

## 📄 License

MIT License. See [LICENSE](LICENSE) for details.

---

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

---

**Made with ❤️ by [KYNetCode](https://github.com/KYNetCode)**
