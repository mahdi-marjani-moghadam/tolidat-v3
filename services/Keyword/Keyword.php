<?php


class Keyword
{
    protected $count = 5;
    protected $keywords = array();
    protected $company;
    protected $keyword_length = 20;
    protected $result = [
        'result' => 1
    ];

    /**
     * Keyword constructor.
     * @param $company
     */
    public function __construct($keywords = null, $company = null)
    {
        $this->company = $company;
        $this->keywords = $keywords;
    }


    public function checkKeyword($packageUsage)
    {
        if (!is_object($packageUsage)) {
            $packageUsage = packageusage::getAll()->where('company_id', '=', $this->company)->first();
        }

        if (is_object($packageUsage)) {
            $result = $this->checkWord($packageUsage);
        }

        if ($result['result'] != 1) {
            return $result;
        }

        return $this->checkCharacter();
    }

    public function checkWord($packageUsage)
    {
        $result['result'] = 1;

        if (count($this->keywords) > $packageUsage->keyword) {
            $result['result'] = -1;
            $result['error']['msg'] = "تعداد کلمات کلیدی بیشتر از حد مجاز است";
        }

        return $result;
    }

    public function checkCharacter()
    {

        $result['result'] = 1;

        foreach ($this->keywords as $keyword) {
            if (mb_strlen($keyword, 'utf-8' ) > $this->keyword_length) {
                $result['result'] = -1;
                $result['error']['msg'] = "تعداد کاراکتر کلمه کلیدی بیشتر از {$this->keyword_length } است";
                break;
            }
        }

        return $result;
    }
}
