<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $optionsGroupTitle }}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form action="{{ route('admin.option-group-save') }}" method="post">
            @csrf
            @foreach ($options as $key => $data)
                @if ($data['translatable'])
                    @foreach ($langs as $lang => $langData)
                        <div class="form-group">
                            <label for="{{ $key }}_{{ $lang }}">{{ $data['label'] }}
                                {{ $lang }}</label>
                            @if ($data['type'] === 'number')
                                <input type="number" name="{{ $key }}[{{ $lang }}]"
                                    value="{{ $data['value'][$lang] ?? '' }}"
                                    id="{{ $key }}_{{ $lang }}" class="form-control">
                            @endif
                            @if ($data['type'] === 'string')
                                <input type="text" name="{{ $key }}[{{ $lang }}]"
                                    value="{{ $data['value'][$lang] ?? '' }}"
                                    id="{{ $key }}_{{ $lang }}" class="form-control">
                            @endif
                            @if ($data['type'] === 'text')
                                <textarea id="{{ $key }}_{{ $lang }}" name="{{ $key }}[{{ $lang }}]"
                                    class="form-control" rows="4">{{ $data['value'][$lang] ?? '' }}</textarea>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <label for="{{ $key }}">{{ $data['label'] }}</label>
                        @if ($data['type'] === 'number')
                            @if (gettype($data['value']) == 'integer')
                                <input type="number" name="{{ $key }}" id="{{ $key }}"
                                    value="{{ $data['value'] }}" class="form-control">
                            @else
                                <input type="number" name="{{ $key }}" id="{{ $key }}"
                                    value="{{ $data['value'][get_current_locale()] }}" class="form-control">
                            @endif
                        @endif
                        @if ($data['type'] === 'string')
                            <input type="text" id="{{ $key }}" name="{{ $key }}"
                                value="{{ $data['value'][get_current_locale()] }}" class="form-control">
                        @endif
                        @if ($data['type'] === 'text')
                            <textarea id="{{ $key }}" name="{{ $key }}" class="form-control" rows="4">{{ $data['value'] }}</textarea>
                        @endif
                        @if ($data['type'] === 'select')
                            <select id="{{ $key }}" name="{{ $key }}" class="form-control">
                                @foreach ($data['options'] as $id => $label)
                                    <option value="{{ $id }}"
                                        @if ($data['value'][get_current_locale()] == $id) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                        @endif
                        @if ($data['type'] === 'multiple_select')
                            <select multiple="multiple" id="{{ $key }}" name="{{ $key }}[]"
                                class="form-control">
                                @foreach ($data['options'] as $id => $label)
                                    <option value="{{ $id }}"
                                        @if ($data['value'][get_current_locale()] == $id) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endif
            @endforeach
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <!-- /.box-body -->
</div>
