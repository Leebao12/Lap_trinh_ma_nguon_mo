@extends('layouts.app')

@section('title', 'Giới thiệu khóa học')

@section('content')

    <h2>Giới thiệu khóa học Lập trình mã nguồn mở</h2>


    {{-- Card 1 --}}
    <x-card title="1. Mục tiêu học phần">

        <p>
            Học phần Lập trình mã nguồn mở giúp sinh viên củng cố
            kiến thức lập trình PHP, lập trình hướng đối tượng,
            làm việc với cơ sở dữ liệu và xây dựng ứng dụng web
            theo mô hình MVC.
        </p>

        <p>
            Sinh viên được làm quen với Laravel Framework,
            cách tổ chức Route, Controller, View, Model
            và thao tác dữ liệu thông qua Eloquent ORM.
        </p>

    </x-card>


    {{-- Card 2 --}}
    <x-card title="2. Lịch 7 buổi Lab">

        <table>
            <thead>
                <tr>
                    <th>Buổi</th>
                    <th>Nội dung</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Lab 1</td>
                    <td>Tổng quan về lập trình web với php và môi trường phát triển hiện đại</td>
                </tr>

                <tr>
                    <td>Lab 2</td>
                    <td>Lập trình hướng đối tượng (OOP) trong php và tích hợp front-end Lập trình với hướng đối tượng trong PHP</td>
                </tr>

                <tr>
                    <td>Lab 3</td>
                    <td>Lập trình hướng đối tượng (OOP) trong php và tích hợp front-end Gi ới thiệu JavaScript và tương tác với PHP</td>
                </tr>

                <tr>
                    <td>Lab 4</td>
                    <td>Tương tác cơ sở dữ liệu với MySQL và PDO Làm việc với Cơ sở dữ liệu MySQL</td>
                </tr>

                <tr>
                    <td>Lab 5</td>
                    <td>Tương tác cơ sở dữ liệu với MySQL và PDO Làm việc với Cơ sở dữ liệu MySQL(Phần nâng cao)</td>
                </tr>

                <tr>
                    <td>Lab 6</td>
                    <td>Laravel Framework Giới thiệu Laravel Framework và cài đặt môi trường</td>
                </tr>

                <tr>
                    <td>Lab 7</td>
                    <td>Laravel Framework Routing nâng cao, Controller RESTful, Blade nâng cao và Form cơ bản</td>
                </tr>
            </tbody>
        </table>

    </x-card>


    {{-- Card 3 --}}
    <x-card title="3. Chuẩn đầu ra mong đợi">

        <ul>
            <li>
                Hiểu được nguyên lý hoạt động của ứng dụng web
                theo mô hình MVC.
            </li>

            <li>
                Xây dựng và sử dụng được Route, Controller
                và Blade View trong Laravel.
            </li>

            <li>
                Biết thiết kế và thao tác cơ sở dữ liệu
                bằng Migration.
            </li>

            <li>
                Thực hiện truy vấn dữ liệu bằng Eloquent ORM.
            </li>

            <li>
                Biết tổ chức mã nguồn rõ ràng,
                dễ bảo trì và tái sử dụng.
            </li>

            <li>
                Có khả năng xây dựng một ứng dụng
                Laravel cơ bản hoàn chỉnh.
            </li>
        </ul>

    </x-card>

@endsection