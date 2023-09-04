
    <!-- Chat messages go here -->
    <div class="message">
        @if (session('chat'))
    @foreach (session('chat') as $c)
        <div class="message">hello</div>
    @endforeach
@endif
        
        <div class="message self">Hi, I have a question.</div>
    </div>