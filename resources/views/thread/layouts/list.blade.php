@forelse($threads as $thread)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="flex">
                <h4>
                    <a href="{{ $thread->path() }}">
                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <span class="font-weight-bold">{{ $thread->title }}</span>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                </h4>
                <h5 class="mb-0">
                    Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                </h5>
            </div>
            <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
        </div>

        <div class="card-body">
            {!! $thread->body !!}
        </div>

        <div class="card-footer">
            {{ $thread->visits }} Visits
        </div>
    </div>
@empty
    <p>There are no relevant results at this time</p>
@endforelse
