@extends('layouts.app')
@section('title', 'Exam')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="">My Exams</h2>

                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <th>
                                Exam title
                            </th>
                            <th>
                                Subject title
                            </th>
                            <th>
                                Date
                            </th>
                            </thead>
                            <tbody>
                            @foreach($user_exams as $exam)
                            <tr>
                                <td>
                                    {{ $exam->title }}
                                </td>
                                <td>
                                    {{ $exam->Subject->title }}
                                </td>
                                <td>
                                    {{ $exam->date }}
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
