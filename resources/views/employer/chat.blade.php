<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        /* Style for the chat container */
        .chat-container {
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        /* Style for individual chat messages */
        .message {
            background-color: #f1f1f1;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }

        /* Style for user's own messages */
        .message.self {
            background-color: #4CAF50;
            color: white;
            text-align: right;
        }

        /* Style for message input field */
        .message-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style for the send button */
        .send-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

  </head>
  <body>
    
    @include('employer.nav_emp')

    <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
      <div class="container">
          <div class="row">
              <div class="col-lg-10  offset-lg-1">
                  <div class="cta-content">
                      <br>
                      <br>
                      <h2>CHAT <em> DASHBOARD</em></h2>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <div class="chat-container">
    <!-- Display chat messages -->
    <div class="message">
        @if (session('chat_messages') && session('chat_messages')->count() > 0)
            @foreach (session('chat_messages') as $message)
                <div class="message">
                    {{ $message->message }}
                </div>
            @endforeach
        @else
            <div>No messages to display.</div>
        @endif
    </div>
    <form action="{{ route('sendchatEmp') }}" method="post">
        @csrf
    <!-- Input field for typing a message -->
    <input type="hidden" name="application_id">
    <input type="hidden" name="jobseeker_id" >
    <input type="hidden" name="employer_id">
        <input type="text" class="message-input" name="message" placeholder="Type a message..." required>
        <input type="submit" value="Send" class="message-input">
    </form>
</div>



    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imgfix.min.js') }}"></script> 
    <script src="{{ asset('js/mixitup.js') }}"></script> 
    <script src="{{ asset('js/accordions.js') }}"></script>
    
    <!-- Global Init -->
    <script src="{{ asset('js/custom.js') }}"></script>
  </body>
</html>