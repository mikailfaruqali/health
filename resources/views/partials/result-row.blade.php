<span class="chip tone-{{ $result['status'] }}"
    ><svg class="i"><use href="#i-{{ $result['icon'] }}" /></svg
></span>
<span class="row__name">{{ $result['name'] }}</span>
<span class="row__meta">
    <span class="time"><svg class="i"><use href="#i-clock" /></svg>{{ $result['time'] }}</span>
    <span class="badge tone-{{ $result['status'] }}">{{ $result['label'] }}</span>
    <a href="{{ $result['rerunUrl'] }}" class="btn btn-ghost" title="Run again"
        ><svg class="i"><use href="#i-rerun" /></svg
    ></a>
</span>
