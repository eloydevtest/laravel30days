<h2> {{ $job->title }} </h2>

<p>
    <strong>Congrats!</strong> Your new job has been published.
</p>

<p>
    <a href="{{url('/jobs/'.$job->id)}}">View your job listing</a>
</p>