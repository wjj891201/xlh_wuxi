<?php

return [
    # 系统后台需要数据
    'formType' => [
        0 => ['key' => 'string', 'name' => '单行文本', 'class' => 'text', 'alter' => 'VARCHAR', 'varlong' => '250'],
        1 => ['key' => 'text', 'name' => '多行文本', 'class' => 'textarea', 'alter' => 'TEXT', 'varlong' => '250'],
        2 => ['key' => 'editor', 'name' => '编辑器', 'class' => 'textarea', 'alter' => 'TEXT', 'varlong' => '250'],
        3 => ['key' => 'htmltext', 'name' => 'HTML文本', 'class' => 'textarea', 'alter' => 'TEXT', 'varlong' => '250'],
        4 => ['key' => 'int', 'name' => ' 整数类型', 'class' => 'text', 'alter' => 'INT', 'varlong' => '11'],
        5 => ['key' => 'float', 'name' => ' 小数类型', 'class' => 'text', 'alter' => 'FLOAT', 'varlong' => '11'],
        6 => ['key' => 'datetime', 'name' => '时间类型', 'class' => 'text', 'alter' => 'INT', 'varlong' => '11'],
        7 => ['key' => 'img', 'name' => '图片附件', 'class' => 'text', 'alter' => 'VARCHAR', 'varlong' => '250'],
        #       8 => ['key' => 'addon', 'name' => '文件附件', 'class' => 'text', 'alter' => 'VARCHAR', 'varlong' => '250'],
        #       9 => ['key' => 'video', 'name' => '视频附件', 'class' => 'text', 'alter' => 'VARCHAR', 'varlong' => '250'],
        10 => ['key' => 'select', 'name' => '下拉框', 'class' => 'select', 'alter' => 'VARCHAR', 'varlong' => '250'],
        11 => ['key' => 'radio', 'name' => '单选框', 'class' => 'radio', 'alter' => 'VARCHAR', 'varlong' => '250'],
        12 => ['key' => 'checkbox', 'name' => '多选框', 'class' => 'checkbox', 'alter' => 'VARCHAR', 'varlong' => '250'],
        13 => ['key' => 'selectinput', 'name' => '复合选项关联输入框', 'class' => 'text', 'alter' => 'VARCHAR', 'varlong' => '250'],
        14 => ['key' => 'decimal', 'name' => '价格', 'class' => 'text', 'alter' => 'FLOAT', 'varlong' => '50'],
    ],
    # 贷款用途
    'loans_usage' => [
            ['id' => 1, 'name' => '扩大经营'],
            ['id' => 2, 'name' => '市场费用'],
            ['id' => 3, 'name' => '公司扩建/装修'],
            ['id' => 4, 'name' => '原材料采购'],
            ['id' => 5, 'name' => '固定资产/设备购买'],
            ['id' => 6, 'name' => '经营周转'],
            ['id' => 7, 'name' => '其他用途']
    ],
    # 企业性质
    'company_type' => [
            ['id' => 1, 'name' => '无'],
            ['id' => 2, 'name' => '有限责任公司'],
            ['id' => 3, 'name' => '股份有限公司'],
            ['id' => 4, 'name' => '国有独资公司'],
            ['id' => 5, 'name' => '个人独资企业'],
            ['id' => 6, 'name' => '合伙企业'],
            ['id' => 7, 'name' => '个体工商户'],
            ['id' => 8, 'name' => '外商投资企业'],
            ['id' => 9, 'name' => '私营企业'],
    ],
    # 融资轮次
    'financing_stage' => [
            ['id' => 1, 'name' => '天使轮'],
            ['id' => 2, 'name' => 'A轮'],
            ['id' => 3, 'name' => 'B轮'],
            ['id' => 4, 'name' => 'C轮'],
            ['id' => 5, 'name' => 'PE轮'],
    ]
];
