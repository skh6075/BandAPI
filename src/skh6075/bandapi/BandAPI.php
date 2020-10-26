<?php

namespace skh6075\bandapi;

class BandAPI{

    private string $token = "";


    /**
     * @param string $token
     * @return $this
     */
    public function setToken (string $token): BandAPI{
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken (): string{
        return $this->token;
    }

    /**
     * @return array
     */
    public function getBands (): array{
        $result = [];

        if (trim ($this->token) !== "") {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2.1/bands?access_token=" . $this->token);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLINFO_HEADER_OUT, true);
            $result = json_decode (curl_exec ($curl), true);
            curl_close($curl);
        } else {
            $result [] = "undefined";
        }
        return $result;
    }

    /**
     * @param string $key
     * @param string $content
     * @param bool $announce
     * @return string[]
     */
    public function writeBandPost (string $key, string $content, bool $announce = true): array{
        if (trim ($this->token) !== "") {
            $curl = curl_init("https://openapi.band.us/v2.2/band/post/create");
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "access_token=" . $this->token . "&band_key=" . $key . "&content=" . urlencode($content) . "&do_push=" . $announce);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLINFO_HEADER_OUT, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ["BandAPI Powered By NaverBand"]);
            $print = json_decode (curl_exec ($curl), true);
            return $print ["result_data"];
        } else {
            return ["undefined"];
        }
    }
}