@foreach($comments as $k => $comment)
    @php
        $user = $comment->user;
        $star = $comment->star;

        $like = $comment->likes()->wherePivot('like', '1')->get();
        $numberLike = count($like);

        $dislike = $comment->likes()->wherePivot('like', '0')->get();
        $numberDisLike = count($dislike);

        $userLike = $comment->likes()->wherePivot('like', '1')->get();
        $userDislike = $comment->likes()->wherePivot('like', '0')->get();
        $activeLike = "";
        foreach($userLike as $k => $like){
            if($like->pivot->comment_id == $comment->id){
                $activeLike = "active";
                break;
            }
        }
        $activeDislikeLike = "";
        foreach($userDislike as $k => $like){
            if($like->pivot->comment_id == $comment->id){
                $activeDislikeLike = "active";
                break;
            }
        }
    @endphp
    @if($user)
    <div class="comment-item">
        <div class="comment-header d-flex aligns-item-center">
            <div class="comment-avatar"> <img class="lazyload" data-src="@if($user) {{ $user->getImage() }} @endif" alt=""></div>
            <div class="comment-info">
                <h6 class="comment-name sub1">@if($user) {{ $user->fullname() }} @endif</h6>
                <div class="rating-star d-flex align-items-center">
                    @for($i = 1; $i < 6; $i++)
                        @if($i <= $star)
                            <img class="star active " src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt="">
                        @else
                            <img class="star " src="{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}" alt="">
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="comment-caption">
            <p>{{ $comment->body }}</p>
            @if($comment->images)
                <img class="lazyload" data-src="{{ asset('images/comments/' . $comment->images ) }}" style="max-width: 200px">
            @endif
        </div>
        <div class="comment-action d-flex align-items-center">
            <div onclick="like(this,1, {{ $comment->id }})" class="action-item like d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-like-gray.svg') }}" alt=""><span class="{{ $activeLike }}">{{ $numberLike }}</span></div>
            <div onclick="like(this,0, {{ $comment->id }})" class="action-item dislike d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-dislike-gray.svg') }}" alt=""><span class="{{ $activeDislikeLike }}">{{ $numberDisLike }}</span></div>
            <div onclick="reply(this, {{ $comment->id  }})" class="action-item reply d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-reply-gray.svg') }}" alt=""><span>Reply</span></div>
            <form action="{{ route('course.likeComment') }}" method="POST">
                @csrf
                <input type="hidden" name="comment_id">
                <input type="hidden" name="like">
            </form>
        </div>
        @php
            $childrens = \App\Comment::where('parent_id', '!=' , 0)->where('parent_id', $comment->id)->get();
        @endphp
        @if($childrens && count($childrens) > 0)
        <div class="reply_comment">
            @foreach($childrens as $k => $item)
                @php
                    $user = $item->user;
                @endphp
            <div class="comment-item">
                <div class="comment-header d-flex aligns-item-center">
                    <div class="comment-avatar"> <img class="lazyload" data-src="@if($user) {{ $user->getImage() }} @endif" alt=""></div>
                    <div class="comment-info">
                        <h6 class="comment-name">@if($user) {{ $user->fullname() }} @endif</h6>
                    </div>
                </div>
                <div class="comment-caption">
                    <p>{{ $item->body }}</p>
                    @if($item->images)
                        <img class="lazyload" data-src="{{ asset('images/comments/' . $item->images ) }}" style="max-width: 200px">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif
@endforeach
