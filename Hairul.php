Не удалось отправить запрос order/reject

Array
(
    [request] => Array
        (
            [data] => Array
                (
                    [token] => 5F6D3C7C-32BF-42F4-9459-3D0A6D8FAA64
                    [shipments] => Array
                        (
                            [0] => Array
                                (
                                    [shipmentId] => 656159675
                                    [orderCode] => 6498
                                    [items] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [itemIndex] => 1
                                                    [offerId] => 1001
                                                )

                                            [1] => Array
                                                (
                                                    [itemIndex] => 2
                                                    [offerId] => 1001
                                                )

                                            [2] => Array
                                                (
                                                    [itemIndex] => 3
                                                    [offerId] => 1001
                                                )

                                        )

                                )

                        )

                )

            [meta] => Array
                (
                )

        )

    [response] => Array
        (
            [meta] => Array
                (
                    [fromProxy] => OSM
                    [requestId] => 8b23ea88-7448-49b9-9ae3-3cce35ce38d0
                )

            [success] => 0
            [error] => Array
                (
                    [0] => Array
                        (
                            [code] => 5
                            [message] => Data error: item not in active status shipmentId=656159675 itemIndex=1
                        )

                    [1] => Array
                        (
                            [code] => 5
                            [message] => Data error: item not in active status shipmentId=656159675 itemIndex=2
                        )

                    [2] => Array
                        (
                            [code] => 5
                            [message] => Data error: item not in active status shipmentId=656159675 itemIndex=3
                        )

                )

        )

)
