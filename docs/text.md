# Text fields

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#form-controls)

## Basic

```$php
{{ bs()->text('username')->placeholder('Username') }}
```

## Read-only

```$php
{{ bs()->text('readonly', 'Read only')->readOnly() }}
```

```$php
{{ bs()->text('plaintext', 'Read only and show as plain text')->readOnly(true) }}
```

## Sizing

Inputs are sizable controls in general.

```$php
{{ bs()->text('username')->placeholder('Small')->sizeSmall() }}
```

```$php
{{ bs()->text('username')->placeholder('Default') }}
```

```$php
{{ bs()->text('username')->placeholder('Large')->sizeLarge() }}
```

## Wrapped inside a form group

It can be wrapped inside a form group if needed.

```$php
{{ bs()->formGroup()
       ->label('Username')
       ->control(bs()->text('username')->placeholder('Username')) }}
```


