<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-tittle">
                <h2>{{$answersCount. "  ".Str::plural('Answer',$answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This Answer is useful" class="vote-up {{Auth::guest()?'off':''}}"
                            onclick="event.preventDefault();document.getElementById('up-vote-answer-{{$answer->id}}').submit()">
                                {{-- <i class="fab fa-instagram text-warning"></i> --}}
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id='up-vote-answer-{{$answer->id}}' action="{{route('answer.vote',$answer->id)}}" method="post">
                                <input type="number" name="vote" value="1" hidden>
                                @csrf
                            </form>
                        <span class="votes-count">{{$answer->votes_count}}</span>
                            <a title="this Answer is not useful" class="vote-down class="vote-up {{Auth::guest()?'off':''}}"
                            onclick="event.preventDefault();document.getElementById('down-vote-answer-{{$answer->id}}').submit()">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id='down-vote-answer-{{$answer->id}}' action="{{route('answer.vote',$answer->id)}}" method="post">
                                <input type="number" name="vote" value="-1" hidden>
                                @csrf
                            </form>
                            @can('acceptBestAnswer', $answer)


                            <a title="Mark this Answer As best Answer"  class="{{$answer->status}} mt-2"
                            onclick="event.preventDefault();document.getElementById('accept-answer-{{$answer->id}}').submit();">
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                            <form id='accept-answer-{{$answer->id}}' action="{{route('answer.accept',$answer->id)}}" method="POST" >
                                @csrf
                            </form>
                            @else
                                    @if ($answer->is_best)
                                        <a title="Question Owner has mark this As best Answer"  class="{{$answer->status}} mt-2">
                                            <i class="fas fa-check fa-2x"></i>
                                        </a>
                                    @endif
                    @endcan
                        </div>
                        <div class="media-body">
                            {!!$answer->body!!}
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a class="btn btn-sm btn-outline-primary" href="{{route('question.answers.edit',[$question->id, $answer->id])}}">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                    <form class="form-delete" method="POST" action="{{route('question.answers.destroy',[$question->id, $answer->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="confirm('Cofirm Question Deletion?')"> Delete</button>
                                    </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">Answered {{$answer->created_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{$answer->user->avatar}}" alt="profile Pic">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$answer->user->url}}"> {{$answer->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>