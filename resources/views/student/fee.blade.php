@extends('layouts.app2')
@section('title','Student | Fees')

@section('content')
    <div class="con-title">
        <h2>My <span> Fees</span></h2>
    </div>
    <table class="table table-responsive">
        <thead class="text-capitalize">
        <th>
            <b>Fee title</b>
        </th>
        <th>
            <b>Amount</b>
        </th>
        <th>
            <b>Due Date</b>
        </th>
        <th>
            <b>Status</b>
        </th>
        </thead>
        <tbody class="text-capitalize">
        @foreach($user_fees as $fee)
            <tr>
                <td>
                    {{ $fee->title }}
                </td>
                <td>
                    {{ $fee->amount }}
                </td>
                <td>
                    {{ $fee->due_date}}
                </td>
                <td>
                    {{ $fee->status}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
