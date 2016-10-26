@extends('layouts.home')

@section('center')
 
    <main>
        <section class="questions">
            <div class="wrapper">
                        <section class="question">
                            <h3><?=$items[0]->title_ge?></h3>
                            <span class="date"><?=$items[0]->author_ge?></span>
                            <p><?=$items[0]->text_ge?></p>
                        </section>
              
                          </div>

        </section>
        @include('comments::display', ['pageId' => 'blog/'.Request::segment(2), 'id' => 'comments'])
    </main>

@endsection

