<ul>
    @foreach ($hierarchicalData as $hierarchyNode)
    <li>
        <span class="tf-nc">{{ $hierarchyNode['user']->name }}</span>
        @if (count($hierarchyNode['children']) > 0)
        <!-- <ul> -->
        @include('partials.treeflex', ['hierarchicalData' => $hierarchyNode['children']])
        <!-- </ul> -->
        @endif
    </li>
    @endforeach
</ul>
