<table class="table table-bordered">
    <thead>
        @if($Endomorph >= 0.5 && $Endomorph <= 2.9)
            <tr>
                <th class="text-center">Bajo</th>
            </tr>
            <tr>
                <th class="text-center">0.5 - 2.9</th>
            </tr>
        @elseif($Endomorph >= 3 && $Endomorph < 5.5)
            <tr>
                <th class="text-center">Moderado</th>
            </tr>
            <tr>
                <th class="text-center">3 - 5.5</th>
            </tr>
        @elseif($Endomorph >= 5.5 && $Endomorph <= 7)
            <tr>
                <th class="text-center">Alto</th>
            </tr>
            <tr>
                <th class="text-center">5.5 - 7</th>
            </tr>
        @elseif($Endomorph > 7)
            <tr>
                <th class="text-center">Muy Alto</th>
            </tr>
            <tr>
                <th class="text-center">> 7.5</th>
            </tr>
        @endif
    </thead>
    <tbody>
        <tr>
            @if($Endomorph >= 0.5 && $Endomorph <= 2.9)
                <td>
                    <p>Poca grasa subcutánea. Contornos musculares y oseos visibles.</p>
                </td>
            @elseif($Endomorph >= 3 && $Endomorph < 5.5)
                <td>
                    <p>Moderada adiposidad relativa. Apariencia más blanda.</p>
                </td>
            @elseif($Endomorph >= 5.5 && $Endomorph <= 7)
                <td>
                    <p>Alta adiposidad relativa. Grasa subcutánea abundante. Acumulación de grasa en el abdomen.</p>
                </td>
            @elseif($Endomorph > 7)
                <td>
                    <p>Adiposidad relativa my alta. Clara acumulación de grasa subcutánea, especialmente en el abdomen.</p>
                </td>
            @endif
        </tr>
    </tbody>
</table>