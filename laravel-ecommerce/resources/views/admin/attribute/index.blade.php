@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>Attribute list</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Attribute list</h3>
                @can('attribute_create')
                <a href="{{ route('attribute.create') }}" class="btn btn-primary" style="float: right;">Attribute add</a>
                @endcan
                @if(session()->has('success'))
                    <div class="callout callout-success" style="margin-top: 20px;">
                        {{ session()->get('success') }}
                    </div>
                @endif
              </div><!-- /.box-header -->
              <div class="box-body">
                <table id="myTable" class="table table-bordered display">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Attribute name</th>
                    <th>Name Key</th>
                    <th>Is Variant</th>
                    <th>Status</th>
                    <th>Attribute Values Name</th>
                    @if(Gate::allows('attribute_edit') or Gate::allows('attribute_delete') or Gate::allows(' attribute_show'))
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @php
                      $i=1;
                  @endphp
                  @forelse($attributes as $attribute)
                    <tr>
                      <td>{{ $i++.'.' }}</td>
                      <td>{{ $attribute->name }}</td>
                      <td>{{ $attribute->name_key }}</td>
                      <td>{{ ($attribute->is_variant==1) ? 'YES':'NO' }}</td>
                      <td>{{ ($attribute->status==1) ? 'Enable':'Diable' }}</td>
                      <td>{{ implode(', ', $attribute->attributeValues->pluck('name')->toArray()) }}</td>
                      @if(Gate::allows('attribute_edit') or Gate::allows('attribute_delete') or Gate::allows(' attribute_show'))
                      <td>
                        @can('attribute_edit')
                        <a href="{{ route('attribute.edit', $attribute->id) }}" class="btn btn-primary" style="float: left;margin-right:4px;">Edit</a>
                        @endcan
                        @can('attribute_show')
                        <a href="{{ route('attribute.show', $attribute->id) }}" class="btn btn-success" style="float: left;margin-right:4px;">Show</a>
                        @endcan
                        @can('attribute_delete')
                        <form action="{{ route('attribute.destroy', $attribute->id) }}" method="POST" style="float: left;">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                        @endcan
                      </td>
                      @endif
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" align="center">No data found.</td>
                    </tr>
                  @endforelse
                </tbody>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
    </div>
</section>
@endsection



{{-- @foreach($attributes as $test)



@foreach($test->attributeValues as $_test)

    @php
        echo $_test->name;
    @endphp

@endforeach


@endforeach --}}