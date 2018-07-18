<div class="row" xmlns="http://www.w3.org/1999/html">
    @if($model->allow_comments)
        <div class="col-md-12">
            <div class="mbottom">
                <h4 class="white text-center ">
                    <span class="captial fontsize18 lineheight50 gold">Please Fill To Comment</span><br/>
                </h4>
                <div class="para black">
                    <div class="contact_left wow">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert"><span class="fa fa-times"></span> </button>
                                <strong>{{ $message }}</strong>

                            </div>

                        @endif
                        {!! Form::open(['route'=>$url, 'role' => 'form']) !!}
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                @endif
                                    <input type="hidden" name="slug" id="slug" value="{{ $model->slug }}" class="form-control wpcf7-text">
                                <textarea name="body" id="body" class="form-control wpcf7-textarea" placeholder="What would you like to tell us">{{ old('body') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group" style="float: none">
                                <label for="anonymouse" style="float: none">Don't to use email and name ?</label>
                                <input type="checkbox" name="anonymouse" id="anonymouse" class="wpcf7-text" placeholder="Your name">
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                @endif
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control wpcf7-text" placeholder="Your name">
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                                <input type="text" name="email" id="email" {{ old('email') }} class="form-control wpcf7-email" placeholder="Email address">
                            </div>
                        </div>
                            <div class="col-md-8 col-md-offset-2">
                                <input type="submit" name="submit" value="Submit" class="btn btn-danger wpcf7-submit photo-submit">
                        {!! Form::close() !!}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="clear height30"></div>
    <div class="col-md-12">

            @if(count($comments) == 0)
                <p> No Comment Available at this time. </p>
            @else
                @foreach($comments as $comment)
                    @if($comment->approved)
                    <div class="comments" id="comment-lists">
                        <div class="pull-left comment-body">
                            <span class="body-comments">
                                {{ $comment->body }}
                            </span>
                            <p class="text-left comment-by">-by {{ $comment->name }}</p>
                        </div>
                        <span class="pull-right comment-date">
                        {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                        </span>
                        <div class="dotted_divider"></div>
                    </div>
                    @endif
                @endforeach
            @endif
    </div>

</div>
@push('scripts')
<script type="text/javascript">

    $("input[id=anonymouse]").on('change',function(){
        var name = $("input[id=name]");
        var email = $("input[id=email]");
        if(this.checked){
            name.css('display','none');
            email.css('display','none');
        }else{
            email.css('display', '');
            name.css('display','');
        }
    });
</script>

@endpush