# Badges

[Bootstrap documentation](https://getbootstrap.com/docs/4.1/components/badge/)

## Basic usage

```$php
{{ bs()->badge()->text('Secondary by default') }}
```

```$php
{{ bs()->badge()->text('Show as a pill')->pill() }}
```

```$php
{{ bs()->badge('info')->text('I am clickable!')->link('#') }}
```

## All badges types

```$php
<table class="table">
    @foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $type)
        <tr>
            <th>{{ $type }}</th>
            <td>{{ bs()->badge($type)->text($type) }}</td>
        </tr>
    @endforeach
</table>
```



