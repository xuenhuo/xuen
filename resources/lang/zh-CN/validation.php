<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute 必须接受',
    'active_url' => ':attribute 不是有效的 URL',
    'after' => ':attribute 必须是 :date 之后的日期',
    'after_or_equal' => ':attribute 必须是小于或等于 :date 的日期',
    'alpha' => ':attribute 只允许包含字母',
    'alpha_dash' => ':attribute 只允许包含字母、数字、括折号和下划线',
    'alpha_num' => ':attribute 只允许包含字母和数字',
    'array' => ':attribute 必须是数组',
    'before' => ':attribute 必须是 :date 之前的日期',
    'before_or_equal' => ':attribute 必须早于或等于 :date 的日期',
    'between' => [
        'numeric' => ':attribute 必须大于 :min 并且小于 :max 的数值',
        'file' => ':attribute 必须大于 :min 并且小于 :max KB',
        'string' => ':attribute 必须大于 :min 并且小于 :max 个字符',
        'array' => ':attribute 必须大于 :min 并且小于 :max 项',
    ],
    'boolean' => ':attribute 必须是 true 或 false',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => ':attribute 不是有效的日期类型',
    'date_equals' => ':attribute 必须等于 :date',
    'date_format' => ':attribute 的格式与 :format 不匹配。',
    'different' => ':attribute 和 :other 不能相同。',
    'digits' => ':attribute 必须是 :digits 位数',
    'digits_between' => ':attribute 必须是 :min ~ :max 位数。',
    'dimensions' => ':attribute 的尺寸不在限定范围内',
    'distinct' => ':attribute 存在相同的值',
    'email' => ':attribute 必须是有效的电子邮箱地址',
    'ends_with' => ':attribute 必须以 :values 结尾',
    'exists' => '当前选定的 :attribute 无效',
    'file' => ':attribute 必须是一个文件',
    'filled' => ':attribute 必须输入一个值',
    'gt' => [
        'numeric' => ':attribute 必须大于 :value',
        'file' => ':attribute 必须大于 :value KB',
        'string' => ':attribute 必须大于 :value 个字符',
        'array' => ':attribute 必须选定 :value 个选项',
    ],
    'gte' => [
        'numeric' => ':attribute 必须大于或等于 :value',
        'file' => ':attribute 必须大于或等于 :value KB',
        'string' => ':attribute 必须大于或等于 :value 个字节',
        'array' => ':attribute 必须包含 :value 个以上的选项',
    ],
    'image' => ':attribute 必须是一个图像',
    'in' => '选定的 :attribute 是无效值',
    'in_array' => ':attribute 不在 :other 中',
    'integer' => ':attribute 必须是整数',
    'ip' => ':attribute 必须是一个有效的 IP 地址',
    'ipv4' => ':attribute 必须是一个有效的 IPv4 地址',
    'ipv6' => ':attribute 必须是一个有效的 IPv6 地址',
    'json' => ':attribute 必须是一个有效的 JSON 字符串',
    'lt' => [
        'numeric' => ':attribute 必须小于 :value',
        'file' => ':attribute 必须小于 :value KB',
        'string' => ':attribute 必须小于 :value 个字符',
        'array' => ':attribute 必须小于 :value 个选项',
    ],
    'lte' => [
        'numeric' => ':attribute 必须小于或等于 :value.',
        'file' => ':attribute 必须小于或等于 :value KB',
        'string' => ':attribute 必须小于或等于 :value 个字符',
        'array' => ':attribute 不能超过 :value 个选项',
    ],
    'max' => [
        'numeric' => ':attribute 不能大于 :max',
        'file' => ':attribute 不能大于 :max KB',
        'string' => ':attribute 不能大于 :max 个字符',
        'array' => ':attribute 不能大于 :max 个选项',
    ],
    'mimes' => ':attribute 的类型必须是: :values',
    'mimetypes' => ':attribute 的类型必须是: :values',
    'min' => [
        'numeric' => ':attribute 不能小于 :min',
        'file' => ':attribute 不能小于 :min KB',
        'string' => ':attribute 不能小于 :min 个字符',
        'array' => ':attribute 不能小于 :min 个选项',
    ],
    'not_in' => '选项 :attribute 无效',
    'not_regex' => ':attribute 格式无效',
    'numeric' => ':attribute 必须是数值',
    'password' => '密码错误',
    'present' => ':attribute 必须存在',
    'regex' => ':attribute 格式无效',
    'required' => ':attribute 必须填写',
    'required_if' => '当 :other 等于 :value 时 :attribute 必须填写',
    'required_unless' => '如果 :values 包含 :other 则必须输入 :attribute 的值',
    'required_with' => '如果 :values 存在时，则必须输入 :attribute 的值',
    'required_with_all' => '如果 :values 存在时，则必须输入 :attribute 的值',
    'required_without' => '如果 :values 不存在时，则必须输入 :attribute 的值',
    'required_without_all' => '如果 :values 没有值，则必须输入 :attribute 的值',
    'same' => ':attribute 和 :other 必须匹配',
    'size' => [
        'numeric' => ':attribute 必须是 :size.',
        'file' => ':attribute 必须是 :size KB',
        'string' => ':attribute 必须是 :size 个字节',
        'array' => ':attribute 必须选定 :size 个选项',
    ],
    'starts_with' => ':attribute 必须以: :values 开头',
    'string' => ':attribute 必须是字符串',
    'timezone' => ':attribute 必须是有效的区域',
    'unique' => ':attribute 已存在',
    'uploaded' => ':attribute 上传失败',
    'url' => ':attribute 格式无效',
    'uuid' => ':attribute 必须是一个有效的 UUID',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        //ads
        'ad_name' => '广告标题',
        'ad_description' => '广告描述',
        'ad_photo' => '广告图片',
        //news
        'news_title' => '新闻标题',
        'news_author' => '作者',
        'news_content' => '新闻内容',
        'news_date' => '日期',
        //articles
        'title' => '文章标题',
        'author' => '作者',
        'address' => '文章位置',
        'content' => '文章内容',
        'article_photo' => '文章图片',
        'article_date' => '日期',
        //products
        'product_name' => '产品名称',
        'product_number' => '产品编号',
        'product_packing' => '包装方式',
        'packing_quantity' => '装箱数量',
        'gross_weight' => '毛重',
        'net_weight' => '净重',
        'packing_specification' => '外箱规格',
        'product_remark' => '产品备注',
        'product_description' => '产品描述',
        'photo' => '产品图片',
        'product_date' => '日期',
    ],

];