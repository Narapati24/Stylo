@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Total Products</h3>
            <p style="font-size: 2rem; font-weight: bold;">120</p>
        </div>
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Total Orders</h3>
            <p style="font-size: 2rem; font-weight: bold;">45</p>
        </div>
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Revenue</h3>
            <p style="font-size: 2rem; font-weight: bold;">Rp 15.000.000</p>
        </div>
    </div>
@endsection
