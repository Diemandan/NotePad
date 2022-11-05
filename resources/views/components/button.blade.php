<form action="/notes/{{ $slot }}" method="POST">
    @method('DELETE')
    @csrf
<input style="float: right;color: red" type="submit" value="{{$value}}" class="btn btn-success mt-2"         >
                </form>