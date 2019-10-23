@extends('layouts.app')
@section('title','Student | Fees')

@section('content')
    <div class="con-title">
        <h2>My <span> Fees</span></h2>
    </div>
    <table class="table table-responsive">
        <thead class="text-capitalize">
        <th>
            <b>Fee Type</b>
        </th>
        <th>
            <b>Amount</b>
        </th>
        <th>
            <b>Due Date</b>
        </th>
        <th>
            <b>Submitted amount</b>
        </th>
        <th>
            <b>Submission date</b>
        </th>
        <th>
            <b>Status</b>
        </th>
        </thead>
        <tbody class="text-capitalize">
        @foreach($user->feeTypes as $feeType)
            <tr>
                <td>
                    <b>{{ $feeType->type }}</b>
                </td>
                <td>
                    {{ $feeType->pivot->amount }}
                </td>
                <td>
                    {{ $feeType->pivot->due_date}}
                </td>
                <td>
                    {{ $feeType->pivot->submitted_amount}}
                </td>
                <td>
                    {{ $feeType->pivot->submission_date}}
                </td>
                <td>
                    <span style="background-color: {{$feeType->pivot->status == 'pending' ? 'red' : 'green'}};
                        color: white; font-weight: bold;">{{ $feeType->pivot->status}}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
