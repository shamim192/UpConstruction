@extends('frontend.layouts.layout')


@section('content')
<!-- Header-Area-Start -->
@include('frontend.sections.hero')
<!-- Header-Area-End -->

<!-- Quote-Area-Start -->
@include('frontend.sections.quote')
<!-- Quote-Area-End -->

<!-- Construction-Area-Start -->
@include('frontend.sections.construction')
<!-- Construction-Area-End -->

<!-- Service-Area-Start -->
@include('frontend.sections.service')
<!-- Service-Area-End -->

<!-- Alt Service-Area-Start -->
@include('frontend.sections.alt-service')
<!-- Alt Service-Area-End -->

<!-- Feature -Area-Start -->
@include('frontend.sections.feature')
<!-- Feature -Area-End -->

<!-- Project-Area-Start -->
@include('frontend.sections.project')
<!-- Project-Area-End -->

<!-- Testimonial-Area-Start -->
@include('frontend.sections.testimonial')
<!-- Testimonial-Area-End -->

<!-- Blog-Area-Start -->
@include('frontend.sections.blog')
<!-- Blog-Area-End -->

@endsection