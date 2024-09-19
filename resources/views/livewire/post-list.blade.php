<div class="container my-1">
    @if ($posts->count() > 0)
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->description }}</p>
                </div>
                <div class="card-footer">
                    <button wire:click="showAddComment({{ $post->id }})" class="btn btn-primary">
                        Comments: {{ $post->comments->count() }}
                    </button>
                    @if ($showCommentModal && $selectedPost->id === $post->id)

                    <div class="mt-2">
                        @foreach ($post->comments as $comment)
                        <div class="card mb-2">
                            <h5 class="card-title mx-3 d-flex align-items-center mt-3">
                                <img src="https://phurpawangchuk.github.io/images/profilepicture.jpeg"
                                    class="rounded-circle" style="height: 20px; border-radius: 50%; margin-right: 8px;">
                                {{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}
                            </h5>
                            <div class="card-body">
                                <p class="card-text">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <h5 class="m-1">Add Comment</h5>
                    <div class="mt-2">
                        @auth
                        <textarea wire:model="newComment" class="form-control"></textarea>
                        <button wire:click="addComment" class="btn btn-primary mt-2">Submit</button>
                        <button wire:click="close" class="btn btn-danger mt-2">Cancel</button>
                        @else
                        <textarea class="form-control" disabled placeholder="Please log in to add a comment"></textarea>
                        <div class="mt-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">Log in to post a comment</a>
                        </div>
                        <div class="mt-2">
                            <button wire:click="close" class="btn btn-danger mt-2">Hide</button>
                        </div>
                        @endauth
                    </div>

                    @endif
                </div>
            </div>
        </div>

        @endforeach
    </div>
    @else
    <div class="alert alert-info">No posts found.</div>
    @endif
</div>