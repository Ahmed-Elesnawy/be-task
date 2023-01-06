@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>@lang('Tasks')({{ $tasks->total() }})</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Title')</th>
                            <th scope="col">@lang('Description')</th>
                            <th scope="col">@lang('Admin name')</th>
                            <th scope="col">@lang('Assigend to')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->assignedBy?->name }}</td>
                                <td>{{ $task->assignedTo?->name }}</td>
                            </tr>
                        @empty
                            <p>No Tasks Available</p>
                        @endforelse
                    </tbody>
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    @endsection
