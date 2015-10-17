@extends(&#x27;app&#x27;)

@section(&#x27;content&#x27;)

&#x3C;div id=&#x22;top-section&#x22;&#x3E;
&#x9;&#x3C;br /&#x3E;
&#x9;&#x3C;br /&#x3E;
&#x9;&#x3C;h1 id=&#x22;pageheader&#x22;&#x3E;
&#x9;&#x3C;small&#x3E;A Gallery of&#x3C;/small&#x3E;
&#x9;The World&#x27;s Finest Panoramic Pictures&#x3C;/h1&#x3E;
&#x9;
&#x9;&#x3C;h3 class=&#x22;text-center&#x22;&#x3E;All images free to use as you choose.&#x3C;br /&#x3E;&#x3C;small&#x3E;Available under &#x3C;a href=&#x22;http://creativecommons.org/publicdomain/zero/1.0/&#x22; target=&#x22;_blank&#x22;&#x3E;Creative Commons Zero&#x3C;/a&#x3E;&#x3C;/small&#x3E;.&#x3C;/h3&#x3E;
&#x3C;/div&#x3E;

&#x9;&#x3C;div class=&#x22;image-container&#x22;&#x3E;
&#x9;@foreach($images as $image)

&#x9;&#x9;@include(&#x27;images/item&#x27;,[&#x27;image&#x27; =&#x3E; $image])

&#x9;@endforeach
&#x9;&#x3C;/div&#x3E;

&#x9;@if($images-&#x3E;hasMorePages())
&#x9;&#x9;&#x3C;div class=&#x22;text-center&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;br /&#x3E;
&#x9;&#x9;&#x9;&#x3C;i class=&#x22;fa fa-spin fa-spinner fa-4x text-warning&#x22;&#x3E;&#x3C;/i&#x3E;
&#x9;&#x9;&#x9;&#x3C;br /&#x3E;
&#x9;&#x9;&#x9;&#x3C;h4&#x3E;Loading more panoramics...&#x3C;/h4&#x3E;
&#x9;&#x9;&#x9;
&#x9;&#x9;&#x9;&#x9;&#x3C;a  href=&#x22;{{ $images-&#x3E;nextPageUrl() }}&#x22; style=&#x22;visibility: hidden&#x22; class=&#x22;next-page btn btn-warning&#x22;&#x3E;Next Page&#x3C;/a&#x3E;
&#x9;&#x9;&#x3C;/div&#x3E;
&#x9;@endif
@stop