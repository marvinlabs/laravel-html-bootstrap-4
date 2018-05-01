# Select

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/forms/#select-menu)

## Basic usage

```$php
{{ bs()->select('country', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'], 'P') }}
```

## Multiple select

```$php
{{ bs()->select('countries', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'])
       ->multiple()
       ->value(['P', 'FR']) }}
```

## Placeholder

```$php
{{ bs()->select('country', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'])
       ->placeholder('Sélectionnez un pays') }}
```

You can set a custom value for the placeholder option too

```$php
{{ bs()->select('country', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'])
       ->placeholder('Sélectionnez un pays', -1) }}
```

## Disabled

```$php
{{ bs()->select('country', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'], 'P')
       ->disabled() }}
```

## Wrapped inside a form group

It can be wrapped inside a form group if needed.

```$php
{{ bs()->formGroup()
       ->label('Country')
       ->control(bs()->select('country', ['FR' => 'France', 'S' => 'Sweden', 'P' => 'Portugal'], 'P')) }}
```


