@extends('layouts.app')
@section('title', 'Notice Board')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <h2 style="background-color: white;">My Announcements</h2><br>
                    <table class="table" style="background-color: white;">
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
                        @foreach($all_announcements as $announcement)
                            <tr>
                                <td>
                                    {{ $announcement->title }}
                                </td>
                                <td>
                                    {{ $announcement->slug }}
                                </td>
                                <td>
                                    {{ $announcement->content }}
                                </td>
                                <td>
                                    {{ $announcement->date }}
                                </td>
                                <td>
                                    {{ $announcement->remarks }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
</div>
@endsection
