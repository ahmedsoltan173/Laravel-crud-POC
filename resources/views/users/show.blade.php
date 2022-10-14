@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th >{{ $user->id }}</th>
          </tr>
            <tr>
            <th scope="col">name</th>
            <th >{{ $user->name }}</th>
          </tr>
            <tr>
            <th scope="col">email</th>
            <th >{{ $user->email }}</th>
          </tr>
          <tr>
            <th>
                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success">edit</a>
            </th>
            <th>
            <form action="{{ route('user.delete',$user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit"class="btn btn-danger" value="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
            </form>
        </th>
        <th>
            <a href="{{ route('user') }}" class="btn btn-info">back</a>
        </th>
    </tr>
        </thead>
      </table>
</div>
@endsection
