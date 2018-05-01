# Buttons

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/buttons/)

## Basic usage

```$php
{{ bs()->button('Plain button', 'secondary') }}
```

```$php
{{ bs()->button('Outlined button', 'secondary', true) }}
```

```$php
{{ bs()->a('#', 'Link as a button')->asButton('secondary') }}
```

## All buttons types

```$php
<table class="table">
    @foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $type)
        <tr>
            <th>{{ $type }}</th>
            <td>{!! bs()->submit($type, $type) !!}</td>
            <td>{!! bs()->submit($type, $type, true) !!}</td>
            <td>{!! bs()->a('#', $type)->asButton($type) !!}</td>
        </tr>
    @endforeach
</table>
```



