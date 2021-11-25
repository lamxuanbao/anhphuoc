@extends('storefront.layouts.default')

@section('content')
    @include('storefront.layouts.partials._header')
    <div class="container">
        <div class="card">
            <article class="card-body">
                <table class="table custom-table">
                    <thead>
                    <tr>
                        <th scope="col">
                            <label class="control control--checkbox">
                                <input type="checkbox" class="js-check-all" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>
                        <th scope="col">Order</th>
                        <th scope="col">Name</th>
                        <th scope="col">Occupation</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Education</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                            <label class="control control--checkbox">
                                <input type="checkbox" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>
                        <td>1392</td>
                        <td>James Yates</td>
                        <td>Web Designer</td>
                        <td>+63 983 0962 971</td>
                        <td>NY University</td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label class="control control--checkbox">
                                <input type="checkbox" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>
                        <td>4616</td>
                        <td>Matthew Wasil</td>
                        <td>Graphic Designer</td>
                        <td>+02 020 3994 929</td>
                        <td>London College</td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label class="control control--checkbox">
                                <input type="checkbox" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>
                        <td>9841</td>
                        <td>Sampson Murphy</td>
                        <td>Mobile Dev</td>
                        <td>+01 352 1125 0192</td>
                        <td>Senior High</td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label class="control control--checkbox">
                                <input type="checkbox" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>
                        <td>9548</td>
                        <td>Gaspar Semenov</td>
                        <td>Illustrator</td>
                        <td>+92 020 3994 929</td>
                        <td>College</td>
                    </tr>
                    </tbody>
                </table>
            </article>
        </div>
    </div>
@endsection
