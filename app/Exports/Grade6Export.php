<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\Models\Grade6View;

class Grade6Export implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $headers = ['id', 'Email', 'Year', 'Surname', 'Other Names', 'DoB', 'BC', 'Medium', 'Religion', 'Denomination', 'Baptism Date', 'Present School', 'Present School Joined', 'Previous Schools', 'Father Name', 'Father Employment', 'Father Occupation', 'Father Mobile', 'Father Email', 'Father Address', 'Father Old School', 'Father Income', 'Mother Name', 'Mother Employment', 'Mother Occupation', 'Mother Mobile', 'Mother Email', 'Mother Address', 'Mother Old School', 'Mother Income', 'Mount From', 'Mount To', 'Mount Admission', 'Mount House', 'Prep From', 'Prep To', 'Guru From', 'Guru To', 'Banda From', 'Banda To', 'OBA Membership', 'OBA Joined Date', 'Mother Staff', 'Mother Staff Section', 'Mother Staff Joined', 'Mother Staff EPF', 'Father Staff', 'Father Staff Section', 'Father Staff Joined', 'Father Staff EPF', 'Other Name 1', 'Other Class 1', 'Other Admission 1', 'Other House 1', 'Other Medium 1', 'Other Joined 1', 'Other Joined Grade 1', 'Other Name 2', 'Other Class 2', 'Other Admission 2', 'Other House 2', 'Other Medium 2', 'Other Joined 2', 'Other Joined Grade 2', 'Other Name 3', 'Other Class 3', 'Other Admission 3', 'Other House 3', 'Other Medium 3', 'Other Joined 3', 'Other Joined Grade 3', 'Other Name 4', 'Other Class 4', 'Other Admission 4', 'Other House 4', 'Other Medium 4', 'Other Joined 4', 'Other Joined Grade 4', 'Schol Index', 'Schol Mark', 'Societies', 'Sports', 'Other', 'Application Link'];
        $data = Grade6View::all();
        return [
            $headers,
            $data,
        ];
    }
}


/*
CREATE VIEW grade6 AS
    SELECT 
        applicants.id as 'id', 
        applicants.email as 'email',
        applicants.year as 'year',
        children.surname as 'surname',
        children.other_names as 'other_names',
        children.dob as 'dob',
        children.bc_num as 'bc_num',
        children.medium as 'medium',
        children.religion as 'religion',
        children.denomination as 'denomination',
        children.baptism_date as 'baptism_date',
        children.present_school AS 'present_school',
        children.present_school_joined AS 'present_school_joined',
        children.previous_schools AS 'previous_schools',
        fathers.name as 'father_name',
        fathers.employment as 'father_employment',
        fathers.occupation as 'father_occupation',
        fathers.mobile as 'father_mobile',
        fathers.email as 'father_email',
        fathers.address as 'father address',
        if(fathers.old_thomian=1, "Old Boy", fathers.old_school) as 'father_old_school',
        fathers.income as 'father income',
        mothers.name as 'mother_name',
        mothers.employment as 'mother_employment',
        mothers.occupation as 'mother_occpation',
        mothers.mobile as 'mother_mobile',
        mothers.email as 'mother_email',
        mothers.address as 'mother_address',
        mothers.old_school as 'mother_old_school',
        mothers.income as 'mother income',
        o_b_a_s.mount_from as 'oba_mount_from',
        o_b_a_s.mount_to as 'oba_mount_to',
        o_b_a_s.admission as 'admission',
        o_b_a_s.house as 'house',
        o_b_a_s.prep_from as 'oba_prep_from',
        o_b_a_s.prep_to as 'oba_prep_to',
        o_b_a_s.guru_from as 'oba_guru_from',
        o_b_a_s.guru_to as 'oba_guru_to',
        o_b_a_s.banda_from as 'oba_banda_from',
        o_b_a_s.banda_to as 'oba_banda_to',
        o_b_a_s.oba_number as 'oba_number',
        o_b_a_s.oba_date as 'oba_date',
        if(staff.mother_staff = 1, "Yes", "No") as 'staff_mother',
        staff.mother_section as 'staff_mother_section',
        staff.mother_joined as 'staff_mother_joined',
        staff.mother_EPF as 'staff_mother_EPF',
        If(staff.father_staff = 1, "YES", "NO") as 'staff_father',
        staff.father_section as 'staff_father_section',
        staff.father_joined as 'staff_father_joined',
        staff.father_EPF as 'staff_father_EPF',
        others.name_1 as 'other_name_1',
        others.class_1 as 'other_class_1',
        others.admission_1 as 'other_admission_1',
        others.house_1 as 'other_house_1',
        others.medium_1 as 'other_medium_1',
        others.joined_1 as 'other_joined_1',
        others.joinedgrade_1 as 'other_joinedgrade_1',
        others.name_2 as 'other_name_2',
        others.class_2 as 'other_class_2',
        others.admission_2 as 'other_admission_2',
        others.house_2 as 'other_house_2',
        others.medium_2 as 'other_medium_2',
        others.joined_2 as 'other_joined_2',
        others.joinedgrade_2 as 'other_joinedgrade_2',
        others.name_3 as 'other_name_3',
        others.class_3 as 'other_class_3',
        others.admission_3 as 'other_admission_3',
        others.house_3 as 'other_house_3',
        others.medium_3 as 'other_medium_3',
        others.joined_3 as 'other_joined_3',
        others.joinedgrade_3 as 'other_joinedgrade_3',
        others.name_4 as 'other_name_4',
        others.class_4 as 'other_class_4',
        others.admission_4 as 'other_admission_4',
        others.house_4 as 'other_house_4',
        others.medium_4 as 'other_medium_4',
        others.joined_4 as 'other_joined_4',
        others.joinedgrade_4 as 'other_joinedgrade_4',
        results.scholindex as 'Schol Index',
        results.scholmark as 'schol mark',
        generals.societies AS 'societies',
        generals.sports AS 'sports',
        generals.other AS 'other',
        concat("https://admissions.stcmount.com/uploads/", applicants.id , "_pdf.pdf") as 'link'
    FROM
        applicants
    INNER JOIN children USING (id)
    INNER JOIN fathers USING (id)
    INNER JOIN mothers USING (id)
    INNER JOIN others USING (id)
    LEFT JOIN o_b_a_s USING (id)
    INNER JOIN staff USING (id)
    INNER JOIN results USING(id)
    INNER JOIN generals USING(id)
    
    WHERE applicants.submitted = 1 and applicants.section='Grade 6';
*/