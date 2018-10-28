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

  'accepted'               => 'يجب قبول :attribute',
  'active_url'             => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
  'after'                  => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
  'after_equal'            => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقا او مساويا  للتاريخ :date.',
  'alpha'                  => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
  'alpha_dash'             => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
  'alpha_num'              => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
  'array'                  => 'يجب أن يكون الحقل :attribute ًمصفوفة',
  'before'                 => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
  'before_equal'           => 'يجب على الحقل :attribute أن يكون تاريخًا سابقا او مساويا للتاريخ :date.',
  'different_days_between' => 'يجب أن تكون فترة العقد محصورة بين :days يوم',
  'between'                => [
    'numeric' => 'يجب أن تكون قيمة :attribute محصورة ما بين :min و :max.',
    'file'    => 'يجب أن يكون حجم الملف :attribute محصورًا ما بين :min و :max كيلوبايت.',
    'string'  => 'يجب أن يكون حقل :attribute محصورًا ما بين :min و :max',
    'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر محصورًا ما بين :min و :max',
  ],
  'boolean'                => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
  'confirmed'              => 'حقل التأكيد غير مُطابق للحقل :attribute',
  'date'                   => 'الحقل :attribute ليس تاريخًا صحيحًا',
  'date_format'            => 'لا يتوافق الحقل :attribute مع الشكل :format.',
  'different'              => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
  'digits'                 => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
  'digits_between'         => 'يجب أن يحتوي الحقل :attribute ما بين :min و :max رقمًا/أرقام ',
  'email'                  => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح',
  'filled'                 => 'الحقل :attribute إجباري',
  'exists'                 => 'الحقل :attribute غير صحيح',
  'image'                  => 'يجب أن يكون الحقل :attribute صورةً',
  'in'                     => 'حقل :attribute غير صحيح',
  'integer'                => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
  'ip'                     => 'يجب أن يكون الحقل :attribute عنوان IP ذي بُنية صحيحة',
  'max'                    => [
    'numeric' => 'يجب أن تكون قيمة الحقل :attribute أصغر من :max.',
    'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :max كيلوبايت',
    'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
    'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
  ],
  'mimes'                  => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
  'min'                    => [
    'numeric' => 'يجب أن تكون قيمة الحقل :attribute أكبر من :min.',
    'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :min كيلوبايت',
    'string'  => 'يجب أن يكون حقل :attribute مكونًا من :min حروف على الأقل.',
    'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
  ],
  'not_in'                 => 'الحقل :attribute لاغٍ',
  'numeric'                => 'يجب على الحقل :attribute أن يكون رقمًا',
  'regex'                  => 'صيغة الحقل :attribute .غير صحيحة',
  'required'               => 'حقل :attribute مطلوب.',
  'required_if'            => 'حقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
  'required_with'          => 'حقل :attribute إذا توفّر :values.',
  'required_with_all'      => 'حقل :attribute إذا توفّر :values.',
  'required_without'       => 'حقل :attribute إذا لم يتوفّر :values.',
  'required_without_all'   => 'حقل :attribute إذا لم يتوفّر :values.',
  'same'                   => 'يجب أن يتطابق حقل :attribute مع :other',
  'size'                   => [
    'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :size.',
    'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :size كيلو بايت.',
    'string'  => 'يجب أن يحتوي النص :attribute عن ما لا يقل عن  :size حرفٍ/أحرف.',
    'array'   => 'يجب أن يحتوي الحقل :attribute عن ما لا يقل عن:min عنصرٍ/عناصر',
  ],
  'timezone'               => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
  'unique'                 => 'قيمة حقل :attribute مُستخدمة من قبل',
  'url'                    => 'صيغة الرابط :attribute غير صحيحة',

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention 'attribute.rule' to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
   */

  'custom'                 => [
    'attribute-name' => [
      'rule-name' => 'custom-message',
    ],
    'recaptcha'      => 'الرجاء اختيار رمز التحقق أعلاه.',
    'after_equal'    => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
  ],
  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of 'email'. This simply helps us make messages a little cleaner.
  |
   */

  'attributes'             => [
    'name'                                     => 'الاسم',
    'username'                                 => 'اسم المُستخدم',
    'email'                                    => 'البريد الالكتروني',
    'first_name'                               => 'الاسم',
    'last_name'                                => 'اسم العائلة',
    'password'                                 => 'كلمة السر',
    'password_confirmation'                    => 'تأكيد كلمة السر',
    'city'                                     => 'المدينة',
    'country'                                  => 'الدولة',
    'address'                                  => 'العنوان',
    'phone'                                    => 'الهاتف',
    'mobile'                                   => 'الجوال',
    'age'                                      => 'العمر',
    'sex'                                      => 'الجنس',
    'gender'                                   => 'النوع',
    'day'                                      => 'اليوم',
    'month'                                    => 'الشهر',
    'year'                                     => 'السنة',
    'hour'                                     => 'ساعة',
    'minute'                                   => 'دقيقة',
    'second'                                   => 'ثانية',
    'title'                                    => 'اللقب',
    'content'                                  => 'المُحتوى',
    'description'                              => 'الوصف',
    'excerpt'                                  => 'المُلخص',
    'date'                                     => 'التاريخ',
    'time'                                     => 'الوقت',
    'available'                                => 'مُتاح',
    'size'                                     => 'الحجم',
    'bundle'                                   => 'الباقة',
    'bundle_name'                              => 'اسم الباقة',
    'establishment_name'                       => 'اسم المنشأة',
    'establishment_num'                        => 'رقم المنشأة',
    'nitaqat_color'                            => 'نطاق المنشأة',
    'establishment_size'                       => 'حجم المنشأة',
    'establishment_allowed_laborer_count'      => 'عدد العمالة المسموحة للمنشأة',
    'laborNum'                                 => 'عدد العمالة المسموحة ',
    'payment_allowed_period'                   => 'مدة السداد (باليوم)',
    'notice_min_validity_period'               => 'الحد الادنى لمدة سريان الاشعار (باليوم)',
    'notice_max_validity_period'               => 'الحد الاقصى لمدة سريان الاشعار (باليوم)',
    'nationality_name'                         => 'الجنسية',
    'nationalities'                            => 'الجنسيات',
    'nationalities-title'                      => 'تمكنك هذه الصفحة من التحكم بالجنسيات',
    'confirm_cancellation_allowed'             => 'تأكيد إلغاء السماح',
    'confirm_cancellation_allowed_msg'         => 'هل تريد بالتاكيد الغاء السماح لهذه الجنسية؟',
    'cancellation_allowed'                     => 'إلغاء السماح',
    'confirm_allowed'                          => 'تأكيد السماح',
    'confirm_allowed_msg'                      => 'هل تريد بالتاكيد السماح لهذه الجنسية؟',
    'are_allowed'                              => 'السماح',
    'allowed'                                  => 'مسموح',
    'choices'                                  => 'خيارات',
    'notallowed'                               => 'غير مسموح',
    'rules'                                    => 'الصلاحيات',
    'loan'                                     => 'نسبة الاعارة%',
    'metaphor'                                 => 'نسبة الاستعارة%',
    'activities'                               => 'الانشطة',
    'activities-title'                         => 'تمكنك هذه الصفحة من التحكم بالانشطة',
    'contracts'                                => ' خدمة العقود',
    'add'                                      => 'اضافة',
    'noData'                                   => 'لا يوجد أي بيانات للعرض',
    'activityModelTitle'                       => 'اضافة/ تعديل الانشطة',
    'activity_name'                            => 'اسم النشاط',
    'save'                                     => 'حفظ',
    'cancel'                                   => 'إلغاء الأمر',
    'activity_loan'                            => 'نسبة الاعارة%',
    'activity_metaphor'                        => 'نسبة الاستعارة%',
    'contract'                                 => 'طبيعة العقود',
    'contracts-title'                          => 'تمكنك هذه الصفحة من التحكم بالعقود',
    'contract_activity'                        => 'نشاط العقد',
    'contract_natural'                         => 'طبيعة العقد',
    'contractModelTitle'                       => 'اضافة / تعديل طبيعة العقد',
    'contract_min_duration'                    => 'الحد الادنى لمدة العقد (باليوم)',
    'contract_max_duration'                    => 'الحد الاقصى لمدة العقد (باليوم)',
    'notification'                             => 'التنبيهات',
    'notifications-title'                      => 'تمكنك هذه الصفحة من التحكم بالتنبيهات',
    'new_contract_request_validity'            => 'مدة صلاحية العقد المقدم (باليوم)',
    'terminate_contract_request_validity'      => 'مدة صلاحية طلب الغاء العقد (باليوم)',
    'notification_receipients'                 => 'تنبيه المستخدمين',
    'type_notification_provider'               => 'مقدم الخدمة',
    'type_notification_beneficiary'            => 'المستفيد من الخدمة',
    'type_notification_all_beneficiaries'      => 'جميع المستفيدين',
    'jobs'                                     => 'المهن',
    'jobs-title'                               => 'تمكنك هذه الصفحة من التحكم المهن',
    'constants'                                => 'الثوابت',
    'constants-title'                          => 'تمكنك هذه الصفحة من التحكم بالثوابت',
    'leasing'                                  => 'خدمة الاعارة',
    'upper_limit_allowable_notices_facilities' => 'الحد الاعلى للاشعارات المسموحة للمنشآت (باليوم) ',
    'upper_limit_allowable_notices_individual' => 'الحد الاعلى للاشعارات المسموحة للفرد (باليوم) ',
    'value_notification'                       => 'قيمة الاشعار الواحد (ريال)',
    'update'                                   => 'تعديل',
    'select_nationality'                       => 'اختر الجنسية لتحميل المهن',
    'allowed_number_laborer'                   => ' عدد العمالة المسموحة',
    'allowed_number_laborer_title'             => 'تمكنك هذه الصفحة من التحكم في عدد العمالة المسموحة لكل منشأة',
    'add/update_number_laborer'                => 'إضافة / تعديل عدد العمالة المسموحة',
    'update_number'                            => 'تغيير عدد العمالة المسموحة',
    'edit'                                     => 'تحرير',
    'activate'                                 => 'تفعيل',
    'activation_sure'                          => 'هل تريد بالتأكيد تفعيل هذه الباقة ؟',
    'activation_confirm'                       => 'تأكيد التفعيل',
    'deactivate'                               => 'إلغاء التفعيل',
    'deactivation_sure'                        => 'هل تريد بالتأكيد إلغاء تفعيل هذه الباقة ؟',
    'deactivation_confirm'                     => 'تأكيد إلغاء التفعيل',
    'no'                                       => 'لا',
    'yes'                                      => 'نعم',
    'status'                                   => 'فعّالة',
    'validity'                                 => 'صلاحية الباقة باليوم',
    'bundle_price'                             => 'قيمة الباقة بالريال السعودي',
    'notices_count'                            => 'عدد الإشعارات',
    'add/update_bundle'                        => 'إضافة / تعديل باقة',
    'bundle_title'                             => 'تمكنك هذه الصفحة من التحكم في الباقات المسموحة لخدمة العقود',
    'bundle_control'                           => 'التحكم بالباقات',
    'notices'                                  => 'الاشعارات',
    'payment'                                  => 'السداد',
    'notice'                                   => 'إشعار',
    'in_day'                                   => 'يوم',
    'reyal'                                    => 'ريال',
    'payment_period'                           => ' قيمة و مدة السداد',
    'notice_validity_period'                   => 'مدة سريان الاشعار',
    'limit_allowable_notices'                  => 'الاشعارات المسموحة',
    'select'                                   => 'اختر',
    'jobs-report-title'                        => '   نسبة/عدد الإشعارات الصادرة حسب المهنة',
    'laborer_name'                             => 'اسم العامل',
    'occupation'                               => 'المهنة',
    'contractType'                             => 'نوع التعاقد',
    'nationality'                              => 'الجنسية',
    'contract_duration'                        => 'مدة العقد',
    'contract_control'                         => 'التحكم بالعقود',
    'activity'                                 => 'النشاط',
    'nitaqat'                                  => 'النطاق',
    'kind_type'                                => 'نوع الطرف',
    'activities-report-title'                  => 'عدد الإشعارات الصادرة حسب النشاط',
    'providers'                                => 'مقدمو الخدمة',
    'benefs'                                   => 'المستفيدون من الخدمة',
    'notifyType'                               => 'نوع الإشعار',
    'notifyType-report-title'                  => 'عدد الإشعارات الصادرة حسب نوع الإشعار',
    'provider_name'                            => 'مقدم الخدمة',
    'benef_name'                               => 'المستفيد',
    'nationalities-report-title'               => 'عدد الإشعارات الصادرة حسب جنسيات العمالة:',
    'sideType-report-title'                    => 'عدد الإشعارات الصادرة حسب نوع الجهة:',
    'notifyStatus-report-title'                => 'عدد الإشعارات حسب حالة الإشعار:',
    'notifyStatus'                             => 'حالة الإشعار',
    'contractStatus-report-title'              => 'عدد الإشعارات حسب حالة العقد:',
    'contractStatus'                           => 'حالة العقد',
    'bundles-report-title'                     => 'عدد العقود حسب الباقة:',
    'bundlesStatus-report-title'               => 'حالات الدفع حسب الباقة:',
    'bundlesStatus'                            => 'حالة الدفع',
    'sideType_name'                            => 'اسم الجهة',
    'sideType'                                 => 'نوع الجهة',
    'numberOfContracts'                        => 'عدد العقود النشطة',
    'numberOfContractNotices'                  => 'عدد اشعارات العمل المؤقت النشطة',
    'numberOfLeasingNotices'                   => 'عدد اشعارات الاعارة النشطة',
    ''                                         => '',
    ''                                         => '',
    ''                                         => '',

  ],

  /*
  |--------------------------------------------------------------------------
  | Platform Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | TODO: import it directly from the package
  |
   */

  "letters"                => ":attribute يجب أن يحوي حرف .",
  "case_diff"              => ":attribute يجب أن يحوي على حرف كبير وصغير.",
  "numbers"                => ":attribute يجب أن يحوي رقم.",
  "symbols"                => ":attribute يجب أن يحوي رمز.",
  "complexity"             => ":attribute يجب أن يحوي على حروف كبيرة وصغيرة وأرقام ورموز.",
  'id_number'              => 'حقل :attribute يجب أن يكون رقم هوية أو إقامة صحيح.',
  'saudi_id'               => 'حقل :attribute يجب أن يكون رقم هوية وطنية صحيح.',
  'iqamah_id'              => 'حقل :attribute يجب أن يكون رقم إقامة صحيح.',
  'alpha_space'            => ':attribute يجب أن يحوي أحرفاً ومسافات فقط.',
  'phone'                  => ':attribute يجب أن يكون رقم هاتف صحيح',
  'gt'                     => ':attribute يجب ان يكون اكبر من :from',
  'gte'                    => ':attribute يجب ان يكون اكبر أو يساوي :from',
  'lt'                     => ':attribute يجب ان يكون أصغر من :from',
  'lte'                    => ':attribute يجب ان يكون أصغر أو يساوي :from',

];
