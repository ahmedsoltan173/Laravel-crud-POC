@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.create') }}"class="btn btn-primary">Create</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">control</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($users as $user)

            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('user.edit',$user->id) }}" class="btn btn-success">edit</a>
                <a href="{{ route('user.show',$user->id) }}" class="btn btn-primary">view</a>
                    <form action="{{ route('user.delete',$user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit"class="btn btn-danger" value="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
      </table>
</div>
@endsection
