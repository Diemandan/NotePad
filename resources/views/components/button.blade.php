<form action="{{ $slot }}" method="POST">
    @method('DELETE')
    @csrf
<input style="{{$style}}" type="submit" value="{{$value}}" class="btn btn-danger mt-0"         >
                </form>