@extends('layouts.app')
@section('title', 'Student Results')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="">My Results</h2>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <th>
                                Result title
                            </th>
                            <th>
                                Subject title
                            </th>
                            <th>
                                Total Marks
                            </th>
                            <th>
                                Obtained Marks
                            </th>
                            <th>
                                Teacher Remarks
                            </th>
                            </thead>
                            <tbody>
                            @foreach($user_results as $result)
                                <tr>
                                    <td>
                                        {{ $result->Exam->title }}
                                    </td>
                                    <td>
                                        {{ $result->Subject->title }}
                                    </td>
                                    <td>
                                        {{ $result->total_marks }}
                                    </td>
                                    <td>
                                        {{ $result->obtained_marks }}
                                    </td>
                                    <td>
                                        {{ $result->remarks }}
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
