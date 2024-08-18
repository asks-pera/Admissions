<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\Models\ALevelView;

class ALevelExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $headers = ['id', 'Email', 'Year', 'Surname', 'Other Names', 'DoB', 'BC', 'Grade / Section', 'Medium', 'Previous School', 'Previous School Joined', 'Father Name', 'Father Employment', 'Father Occupation', 'Father Mobile', 'Father Email', 'Father Address', 'Father Old School', 'Father Income', 'Mother Name', 'Mother Employment', 'Mother Occupation', 'Mother Mobile', 'Mother Email', 'Mother Address', 'Mother Old School', 'Mother Income', 'Religion', 'First Language', 'English', 'Science', 'Mathematics', 'History', 'Basket 1', 'Basket 2', 'Basket 3', 'AL Subject 1', 'AL Subject 2', 'AL Subject 3', 'AL Subject 4', 'Societies', 'Sports', 'Others', 'Application Link'];
        $data = ALevelView::all();
        return [
            $headers,
            $data,
        ];
    }
}

/*
CREATE VIEW alevel AS
    SELECT 
        applicants.id as 'id', 
        applicants.email as 'email',
        applicants.year AS 'year',
        children.surname as 'surname',
        children.other_names as 'other_names',
        children.dob as 'dob',
        children.bc_num as 'bc_num',
        children.grade_sought as 'grade_sought',
        children.medium as 'medium',
        children.present_school as 'present_school',
        children.present_school_joined as 'present_school_joined',
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
        results.olreligion as 'olreligion',
        results.olfirstlang as 'olfirstlang',
        results.olenglish as 'olenglish',
        results.olscience as 'olscience',
        results.olmath as 'olmath',
        results.olhistory as 'olhistory',
        concat(results.olbasket1subject, " - ", results.olbasket1result) as 'olbasket1',
        concat(results.olbasket2subject, " - ", results.olbasket2result) as 'olbasket2',
        concat(results.olbasket3subject, " - ", results.olbasket3result) as 'olbasket3',
        subjects.alsubject1 as 'alsubject1',
        subjects.alsubject2 as 'alsubject2',
        subjects.alsubject3 as 'alsubject3',
        subjects.alsubject4 as 'alsubject4',
        generals.societies AS 'societies',
        generals.sports AS 'sports',
        generals.other AS 'other',
        concat("https://admissions.stcmount.com/uploads/", applicants.id , "_pdf.pdf") as 'link'
    FROM
        applicants
    INNER JOIN children USING (id)
    INNER JOIN fathers USING (id)
    INNER JOIN mothers USING (id)
    INNER JOIN results USING (id)
    INNER JOIN subjects USING (id)
    INNER JOIN generals USING (id)
    
    WHERE applicants.submitted = 1 and applicants.section='ALevels';
    */
