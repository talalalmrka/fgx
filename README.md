# Fgx UI Components

![License](https://img.shields.io/badge/license-MIT-blue.svg)

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Components](#components)
    - [Alert](#alert)
    - [Badge](#badge)
    - [Button](#button)
    - [Card](#card)
    - [Dropdown](#dropdown)
    - [Input](#input)
    - [Modal](#modal)
    - [Table](#table)
  - [Updating caches](#updating-caches)
  - [Available Components](#available-components)
- [Testing](#testing)
- [License](#license)

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

#### Alert

The `Alert` component is used to display alert messages.

**Usage:**

```blade
<fgx:alert type="success" message="Operation completed successfully!" />
```

**Available Props:**

- `type` (string): The type of alert. Possible values: `success`, `error`, `warning`, `info`. Default: `info`.
- `message` (string): The message to display in the alert.

---

#### Breadcrumbs

The `Breadcrumbs` component is used to display a breadcrumb navigation.

**Usage:**

```blade
<fgx:breadcrumbs :links="[
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Dashboard', 'url' => '/dashboard'],
    ['label' => 'Settings']
]" />
```

**Available Props:**

- `links` (array): An array of breadcrumb links. Each link should be an associative array with the following keys:
  - `label` (string): The text to display for the breadcrumb.
  - `url` (string): The URL for the breadcrumb. Optional for the last breadcrumb in the list.
- If `url` is not provided, the breadcrumb will be rendered as plain text.

---

#### Badge

The `Badge` component is used to display small status indicators.

**Usage:**

```blade
<fgx:badge type="success">Active</fgx:badge>
```

**Available Props:**

- `type` (string): The type of badge. Possible values: `success`, `error`, `warning`, `info`. Default: `info`.
- `text` (string): The text to display inside the badge.

---

#### Button

The `Button` component is used to render buttons.

**Usage:**

```blade
<fgx:button type="submit" class="btn-primary">Submit</fgx:button>
```

**Available Props:**

- `type` (string): The button type. Possible values: `submit`, `button`, `reset`. Default: `button`.
- `class` (string): Additional CSS classes for styling the button.
- `disabled` (boolean): Whether the button is disabled. Default: `false`.

---

#### Card

The `Card` component is used to display content within a card layout.

**Usage:**

```blade
<fgx:card title="Card Title">
    <p>This is the card content.</p>
</fgx:card>
```

**Available Props:**

- `title` (string): The title of the card.
- `footer` (string): The footer content of the card. Optional.

---

#### Dropdown

The `Dropdown` component is used to display dropdown menus.

**Usage:**

```blade
<fgx:dropdown label="Actions">
    <fgx:dropdown-item href="/edit">Edit</fgx:dropdown-item>
    <fgx:dropdown-item href="/delete">Delete</fgx:dropdown-item>
</fgx:dropdown>
```

**Available Props:**

- `label` (string): The label for the dropdown.
- `items` (array): An array of dropdown items. Optional.

---

#### Input

The `Input` component is used to render input fields.

**Usage:**

```blade
<fgx:input name="email" type="email" placeholder="Enter your email" />
```

**Available Props:**

- `name` (string): The name attribute of the input field.
- `type` (string): The type of the input field. Default: `text`.
- `placeholder` (string): The placeholder text for the input field.
- `value` (string): The default value of the input field. Optional.

---

#### Modal

The `Modal` component is used to display modal dialogs.

**Usage:**

```blade
<fgx:modal id="exampleModal" title="Modal Title">
    <p>This is the modal content.</p>
</fgx:modal>
```

**Available Props:**

- `id` (string): The unique identifier for the modal.
- `title` (string): The title of the modal.
- `size` (string): The size of the modal. Possible values: `sm`, `md`, `lg`. Default: `md`.

---

#### Table

The `Table` component is used to display tabular data.

**Usage:**

```blade
<fgx:table :headers="['Name', 'Email', 'Role']" :rows="$users" />
```

**Available Props:**

- `headers` (array): An array of column headers.
- `rows` (array): An array of row data.

You can customize the components by publishing the views:

```bash
php artisan vendor:publish --tag=fgx-views
```

### Updating caches

```bash
php artisan config:clear
php artisan config:cache
php artisan view:clear
```

### Available Components

## Testing

To run the tests, use:

```bash
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License.
