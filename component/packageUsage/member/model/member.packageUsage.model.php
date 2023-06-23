<?php

class packageusage extends looeic {

    public function updatePackageUsageWithNewPackage($invoice)
    {
        $package = unserialize($invoice->invoice_detail);
        $packageUsage = packageusage::getAll()->where('company_id', '=', $invoice->company_id)->first();

        if (is_object($packageUsage)) {
            $packageUsage->package_id = $package['Package_id'];
            $packageUsage->invoice_id = $invoice->Invoice_id;
            $packageUsage->product = $package['product'];
            $packageUsage->keyword = $package['keyword'];
            $packageUsage->category = $package['category'];
            $packageUsage->representation = $package['representation'];
            $packageUsage->branch = $package['branch'];
            return $packageUsage->save();
        }
    }

    public static function packageUsageExist($company_id)
    {
        $packageUsage = packageusage::getAll()->where('company_id', '=', $company_id)->first();

        if (!is_object($packageUsage)) {
            return false;
        }

        return true;
    }
}
