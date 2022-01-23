@extends('layouts.app')

@section('content')
	<div class="container mx-auto my-6 px-3">
		<article class="prose prose-sm lg:prose-xl">
			<h1>{{ $page->title }}</h1>
			{!! $page->content !!}
		</article>

	</div>
@endsection