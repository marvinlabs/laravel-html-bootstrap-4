# Text areas

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#form-controls)

## Basic

```$php
{{ bs()->textArea('textArea', 'Lorem ipsum blah blah blah') }}
```

## Read-only

```$php
{{ bs()->textArea('textArea_ro', 'This one is read only')->disabled() }}
```

```$php
{{ bs()->text('plaintext', 'Read only and show as plain text')->readOnly(true) }}
```

## Wrapped inside a form group

It can be wrapped inside a form group if needed.

```$php
{{ bs()->formGroup()
       ->label('Content')
       ->control(bs()->textArea('content', 'Lorem ipsum blah blah blah')) }}
```
