# Fgx UI Components

![License](https://img.shields.io/badge/license-MIT-blue.svg)

## Installation

```bash
composer require talalalmrka/fgx
```

## Configuration

To publish the configuration file, run:

```bash
php artisan vendor:publish --tag=fgx-config
```

## Usage

### Components

You can use the components in your Blade templates. For example:

```blade
<fgx:button type="primary">Click Me</fgx:button>
```

### Customization

You can customize the components by publishing the views:

```bash
php artisan vendor:publish --tag=fgx-views
```

### Available Components

- `fgx-button`
- `fgx-input`
- `fgx-select`
- `fgx-checkbox`
- `fgx-radio-group`
- `fgx-switch`
- `fgx-textarea`
- `fgx-file`
- `fgx-editor`
- `fgx-location`
- `fgx-dropzone`
- `fgx-loader`
- `fgx-label`
- `fgx-info`
- `fgx-error`
- `fgx-success`
- `fgx-status`
- `fgx-fields`
- `fgx-field`
- `fgx-select-choice`
- `fgx-switch-group`
- `fgx-check-group`

## Testing

To run the tests, use:

```bash
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License.
