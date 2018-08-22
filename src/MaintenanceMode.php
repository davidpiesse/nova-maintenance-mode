<?php

namespace Davidpiesse\NovaMaintenanceMode;

/**
 * Class to wrap Artisan Maintenance mode logic
 */
class MaintenanceMode
{
    /**
     * Bring Application out of Maintenance Mode
     *
     * @return void
     */
    public static function up(){
        @unlink(storage_path('framework/down'));
        return;
    }

    /**
     * Put Application into Maintenance Mode
     *
     * @param Request $request
     * @return void
     */
    public static function down($request){

        $props = $request->only(['message', 'retry', 'allow','include_current_ip']);

        $retry = data_get($props, 'retry');

        $retry_seconds = is_numeric($retry) && $retry > 0 ? (int) $retry : null;

        $allowed_ips = [];

        if(!is_null(data_get($props, 'allow'))){
            $allowed_ip_list = str_replace(' ','',data_get($props, 'allow'));
            $allowed_ips = explode(',', $allowed_ip_list);
        }

        if(!is_null(data_get($props, 'include_current_ip'))){
            if(data_get($props, 'include_current_ip')){
                $allowed_ips[] = $request->ip();
            }
        }

        $payload = [
            'time' => now()->timestamp,
            'message' => data_get($props, 'message'),
            'retry' => $retry_seconds,
            'allowed' => array_unique($allowed_ips),
        ];

        file_put_contents(
            storage_path('framework/down'),
            json_encode($payload, JSON_PRETTY_PRINT)
        );

        return;
    }


}