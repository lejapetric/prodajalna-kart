package si.fri.androidclient;

import com.google.gson.annotations.SerializedName;

public class Card {
    @SerializedName(value = "id")
    public Integer id;

    @SerializedName(value = "naziv")
    public String title;

    @SerializedName(value = "cena")
    public String price;

    @SerializedName(value = "aktiviran")
    public Integer aktiviran;

    @SerializedName(value = "seller_email")
    public String sellerEmail;

    @SerializedName(value = "user_id")
    public Integer userId;

    // Opcijsko lahko dodate toString() za debug
    @Override
    public String toString() {
        return title + " - €" + price + " (" + sellerEmail + ")";
    }
}