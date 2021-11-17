<form method="post" action="{{ route('email.send') }}">
    @csrf
    <label for="email">Email: </label>
    <input id="email" type="email" name="email"/>
    <button type="submit">Submit</button>
</form>
