# Input groups

[Bootstrap documentation](https://getbootstrap.com/docs/4.0/components/input-group/)

## Basic

Here are the bootstrap samples reproduced with the library.

```$php
{{ bs()->inputGroup()
       ->prefix('@')
       ->control(bs()->text('username')->placeholder('Username')) }}
```

```$php
{{ bs()->inputGroup()
       ->suffix('@example.com')
       ->control(bs()->text('username')->placeholder("Recipient's username")) }}
```

```$php
{{ bs()->inputGroup()
       ->prefix('$')
       ->suffix('.00')
       ->control(bs()->text('amount')) }}
```

## Sizing

Input groups are sizable controls.

```$php
{{ bs()->inputGroup()
       ->prefix('Small')
       ->control(bs()->text('username'))
       ->sizeSmall() }}
```

```$php
{{ bs()->inputGroup()
       ->prefix('Default')
       ->control(bs()->text('username')) }}
```

```$php
{{ bs()->inputGroup()
       ->prefix('Large')
       ->control(bs()->text('username'))
       ->sizeLarge() }}
```

## Multiple addons

You can add multiple addons before/after the control.

```$php
{{ bs()->inputGroup()
       ->prefix('$')
       ->prefix('0.00')
       ->control(bs()->text('amount')) }}
```

```$php
{{ bs()->inputGroup()
       ->suffix('$')
       ->suffix('0.00')
       ->control(bs()->text('amount')) }}
```


