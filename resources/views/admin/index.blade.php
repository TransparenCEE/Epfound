@extends('layouts.admin')



@section('rightBlock')

    <?php
    $categoryID = Request::segment(3);

    ?>

    <section class="sub-main">

        <section class="sub-main-header">
            <h3>{{$headers[0]->name}}</h3>


            <section class="municipalities-header">
                @if ($categoryID != 5)
                <input type="search" name="" value="" placeholder="" />
                <a href="{{Request::fullUrl().'/add'}}"><img src="{{URL::asset('admin/images/plus.png')}}" alt="" title="" /> მუნიციპალიტეტის დამატება</a>
                    @endif
            </section>
        </section>
        @if(Session::has('dataError'))
           <span style="font-family:'BPG NINO MTAVRULI BOLD'">{{ Session::get('dataError') }}</span>
        @endif
         {{-------------------- Municipalities  ------------------------}}
        <ul class="municipalities-list">
            @foreach ($municipality as $show)

                {{--<li><a href="/admin/subcat/{{ $show->id }}">{{ $show->name }}</a></li>--}}
            <li>
                <span><a href="{{url('admin/showdata/'.$show->id.'/'.$categoryID)}}"> {{$show->name}}</a></span>
                <section class="edit-delete">
                    <a href="{{Request::fullUrl().'/edit/'.$show->id}}"><img src="{{URL::asset('admin/images/pencil.png')}}" alt="" title="" /></a>
                    <a href="{{Request::fullUrl().'/delete/'.$show->id}}" onclick="return confirm('Confirm delete?');"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                </section>
            </li>
            @endforeach
        </ul>

    </section>
    <!--  Municipalities END!!!  -->


@endsection