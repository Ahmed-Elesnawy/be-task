@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>@lang('Statistics')</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Tasks count')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($statistics as $statistic)
                            <tr>
                                <th scope="row">{{ $statistic->id }}</th>
                                <td>{{ $statistic->user?->name }}</td>
                                <td>{{ $statistic->task_count }}</td>
                            </tr>
                        @empty
                            <p>No Statistics Available</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
